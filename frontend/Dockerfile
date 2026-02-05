# frontend/Dockerfile
FROM node:20-alpine

WORKDIR /app

# Install dependencies secara terpisah untuk caching
COPY package*.json ./
RUN npm install

# Install Tailwind CSS v4
RUN npm install tailwindcss@next @tailwindcss/vite

# Copy source code
COPY . .

# Expose port untuk Vite
EXPOSE 5173 24678

# Command akan dioverride di docker-compose
CMD ["npm", "run", "dev"]