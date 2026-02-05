<?php
// ============================================================
// config/kmeans.php — K-Means Clustering (3 Parameter)
// ============================================================
//
// FITUR VECTOR 3 DIMENSI:
// ========================
// Setiap tugas adalah titik di ruang 3D:
//
//   X = Urgency (deadline)
//       → 0.0  : deadline masih jauh (≥ 30 hari)
//       → 1.0  : deadline hari ini atau sudah lewat
//
//   Y = Difficulty
//       → Easy   = 0.33
//       → Medium = 0.67
//       → Hard   = 1.00
//
//   Z = Importance (tingkat kepentingan)
//       → Low    = 0.33
//       → Medium = 0.67
//       → High   = 1.00
//
// K-Means clustering (K=3):
//   - Cluster terdekat ke (1,1,1) → HIGH priority
//   - Cluster terdekat ke (0,0,0) → LOW priority
//   - Sisanya → MEDIUM priority
// ============================================================

class KMeans {
    const K                 = 3;
    const MAX_ITER          = 100;
    const MAX_DEADLINE_DAYS = 30.0;

    // ─── Hitung urgency dari deadline ───────────────────────
    public static function urgency(string $deadline): float {
        $days = (strtotime($deadline) - time()) / 86400;
        if ($days <= 0) return 1.0;
        return round(max(0.0, 1.0 - ($days / self::MAX_DEADLINE_DAYS)), 4);
    }

    // ─── Map difficulty → angka ─────────────────────────────
    public static function difficulty(string $d): float {
        return match(strtolower($d)) {
            'easy'   => 0.33,
            'medium' => 0.67,
            'hard'   => 1.00,
            default  => 0.33,
        };
    }

    // ─── Map importance → angka ─────────────────────────────
    public static function importance(string $i): float {
        return match(strtolower($i)) {
            'low'    => 0.33,
            'medium' => 0.67,
            'high'   => 1.00,
            default  => 0.33,
        };
    }

    /**
     * Klasifikasi task dengan K-Means 3D.
     *
     * @param array  $tasks      Semua task user dari DB:
     *                            [['deadline'=>'...', 'difficulty'=>'...', 'importance'=>'...'], ...]
     * @param string $deadline   Deadline task yang disimpan
     * @param string $diff       Difficulty task yang disimpan
     * @param string $imp        Importance task yang disimpan
     * @return array ['priority'=>1|2|3, 'label'=>'Low'|'Medium'|'High']
     */
    public static function classify(array $tasks, string $deadline, string $diff, string $imp): array {
        // 1. Build point array (3D)
        $points = [];
        foreach ($tasks as $t) {
            $points[] = [
                self::urgency($t['deadline']),
                self::difficulty($t['difficulty']),
                self::importance($t['importance']),
            ];
        }

        // 2. Add target point (task yang sedang disimpan)
        $target = [
            self::urgency($deadline),
            self::difficulty($diff),
            self::importance($imp),
        ];
        $points[] = $target;
        $targetIdx = count($points) - 1;

        // 3. Minimal 3 titik untuk K=3. Tambah anchor jika kurang.
        if (count($points) < self::K) {
            $points[] = [0.0, 0.33, 0.33];  // low
            $points[] = [0.5, 0.67, 0.67];  // mid
            $points[] = [1.0, 1.00, 1.00];  // high
        }

        $n = count($points);

        // 4. Init centroids: spread across dataset
        $centroids = [
            $points[0],
            $points[intdiv($n, 2)],
            $points[$n - 1],
        ];

        $assign = array_fill(0, $n, 0);

        // 5. K-Means iterasi
        for ($iter = 0; $iter < self::MAX_ITER; $iter++) {
            $changed = false;

            // Assignment step
            for ($i = 0; $i < $n; $i++) {
                $best  = 0;
                $bestD = self::dist3d($points[$i], $centroids[0]);
                for ($k = 1; $k < self::K; $k++) {
                    $d = self::dist3d($points[$i], $centroids[$k]);
                    if ($d < $bestD) { $bestD = $d; $best = $k; }
                }
                if ($best !== $assign[$i]) { $assign[$i] = $best; $changed = true; }
            }

            if (!$changed) break;

            // Update centroids
            $sums   = [[0,0,0],[0,0,0],[0,0,0]];
            $counts = [0, 0, 0];
            for ($i = 0; $i < $n; $i++) {
                $k = $assign[$i];
                $sums[$k][0] += $points[$i][0];
                $sums[$k][1] += $points[$i][1];
                $sums[$k][2] += $points[$i][2];
                $counts[$k]++;
            }
            for ($k = 0; $k < self::K; $k++) {
                $centroids[$k] = $counts[$k] > 0
                    ? [
                        $sums[$k][0] / $counts[$k],
                        $sums[$k][1] / $counts[$k],
                        $sums[$k][2] / $counts[$k],
                    ]
                    : [0.5, 0.5, 0.5];
            }
        }

        // 6. Label clusters
        $highCorner = [1.0, 1.0, 1.0];
        $lowCorner  = [0.0, 0.0, 0.0];

        // Cluster terdekat ke (1,1,1) → High
        $highK = 0; $bestD = self::dist3d($centroids[0], $highCorner);
        for ($k = 1; $k < self::K; $k++) {
            $d = self::dist3d($centroids[$k], $highCorner);
            if ($d < $bestD) { $bestD = $d; $highK = $k; }
        }

        // Cluster terdekat ke (0,0,0) dari sisanya → Low
        $lowK = -1; $bestD = PHP_FLOAT_MAX;
        for ($k = 0; $k < self::K; $k++) {
            if ($k === $highK) continue;
            $d = self::dist3d($centroids[$k], $lowCorner);
            if ($d < $bestD) { $bestD = $d; $lowK = $k; }
        }

        // Sisanya → Medium
        $medK = -1;
        for ($k = 0; $k < self::K; $k++) {
            if ($k !== $highK && $k !== $lowK) { $medK = $k; break; }
        }

        // Map cluster → priority
        $map = [];
        $map[$highK] = 3;
        $map[$medK]  = 2;
        $map[$lowK]  = 1;

        $pri = $map[$assign[$targetIdx]];
        return [
            'priority' => $pri,
            'label'    => match($pri) { 3 => 'High', 2 => 'Medium', default => 'Low' },
        ];
    }

    /** Jarak Euclidean 3D */
    private static function dist3d(array $a, array $b): float {
        return sqrt(
            ($a[0]-$b[0])**2 +
            ($a[1]-$b[1])**2 +
            ($a[2]-$b[2])**2
        );
    }
}
