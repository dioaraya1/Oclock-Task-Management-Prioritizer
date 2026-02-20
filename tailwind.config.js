export default {
  content: ["../public/**/*.php", "../src/**/*.php"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Inter", "sans-serif"],
      },
      colors: {
        blue: {
          50: "#eff6ff",
          100: "#dbeafe",
          200: "#bfdbfe",
          400: "#60a5fa",
          500: "#3b82f6",
          600: "#2563eb",
          700: "#1d4ed8",
          900: "#1e3a8a",
        },
      },
      keyframes: {
        "fade-up": {
          "0%": { opacity: "0", transform: "translateY(16px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        "fade-in": {
          "0%": { opacity: "0" },
          "100%": { opacity: "1" },
        },
      },
      animation: {
        "fade-up": "fade-up 0.5s ease both",
        "fade-up-2": "fade-up 0.5s 0.1s ease both",
        "fade-up-3": "fade-up 0.5s 0.2s ease both",
        "fade-up-4": "fade-up 0.5s 0.3s ease both",
        "fade-in": "fade-in 0.8s ease both",
      },
    },
  },
};
