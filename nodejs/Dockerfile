# Gunakan image Node.js dari Docker Hub
FROM node

# Buat direktori app di dalam container
WORKDIR /usr/src/app

# Salin package.json dan package-lock.json (jika ada)
COPY package*.json ./

# Install dependensi npm
RUN npm install

# Salin seluruh kode aplikasi
COPY . .

# Port yang akan digunakan oleh aplikasi
EXPOSE 3001

# Perintah untuk menjalankan aplikasi
CMD ["npm", "run", "start"]
