<template>
    <div class="container mt-5">
      <h2 class="text-center">Dashboard - Agenda Médica</h2>
  
      <div class="row mt-4">
        <div class="col-md-3">
          <div class="card text-center">
            <div class="card-body">
              <h4>Pacientes</h4>
              <p class="fs-2">{{ totalPacientes }}</p>
              <button class="btn btn-primary" @click="$emit('navegar', 'Pacientes')">Ver Pacientes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        totalPacientes: 0
      };
    },
    mounted() {
      this.carregarDados();
    },
    methods: {
      carregarDados() {
        axios.get('http://127.0.0.1:8000/api/pacientes').then(res => {
          this.totalPacientes = res.data.length;
        });
      }
    }
  };
  </script>
  
  <style scoped>
  .card {
    border-radius: 10px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
  }
  </style>
  