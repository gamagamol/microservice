/** @format */

const express = require('express');
const app = express();
const port = 3001;
const cors = require('cors');
const students = require('./db');
const bodyParser = require('body-parser');
require('dotenv').config();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.use(
  cors({
    origin: '*', // Replace with the actual domain of your frontend
    methods: '*',
    credentials: true, // Allow cookies and authentication headers (if needed)
  })
);

app.get('/', async (req, res) => {
  let data = await students.findAll({
    attributes: ['id', 'name', 'progamming'],
    where: {
      progamming: 'node',
    },
  });

  res.status(200).json({
    message: 'Message From Node Js',
    students: data,
  });
});

app.post('/', async (req, res) => {
  let name = req.body.name;
  let progamming = req.body.progamming;
  await students.create(
    {
      name: name,
      progamming: progamming,
    },
    {
      fields: ['name', 'progamming'], // Disable timestamps for this operation
    }
  );

  res.status(200).json({
    message: 'success',
  });
});

app.listen(port, () => {
  console.log('sever from node js are running');
});
