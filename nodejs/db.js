/** @format */

const { Sequelize } = require('sequelize');
const { DataTypes } = require('sequelize');

require('dotenv').config();

// console.log(process.env.DB_USERNAME);
// process.env.USER_ID;

const sequelize = new Sequelize(process.env.DB_NAME, process.env.DB_USERNAME, process.env.DB_PASSWORD, {
  host: process.env.DB_HOST,
  port: process.env.DB_PORT,
  dialect: 'mysql',
});

// Tes koneksi ke database
const db = sequelize
  .authenticate()
  .then(() => {
    console.log('Koneksi ke database berhasil.');
  })
  .catch((err) => {
    console.error('Gagal terkoneksi ke database:', err);
  });

const students = sequelize.define(
  'students',
  {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
    },
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    progamming: {
      type: DataTypes.STRING,
      allowNull: false,
    },
  },
  {
    // Nonaktifkan timestamps (createdAt dan updatedAt)
    timestamps: false,
  }
);

module.exports = students;
