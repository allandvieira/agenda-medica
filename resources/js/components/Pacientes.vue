<template>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Pacientes</h2>
        <button class="btn btn-primary mb-3" @click="abrirFormulario()">Adicionar Paciente</button>

        <!-- Formulário de Cadastro/Edição -->
        <div v-if="mostrarFormulario" class="card p-3 mb-3">
            <h4>{{ modoEdicao ? 'Editar Paciente' : 'Novo Paciente' }}</h4>

            <input v-model="pacienteSelecionado.nome" class="form-control mb-2" placeholder="Nome">
            <span v-if="erros.nome" class="text-danger">{{ erros.nome }}</span>

            <input v-model="pacienteSelecionado.email" type="email" class="form-control mb-2" placeholder="E-mail">
            <span v-if="erros.email" class="text-danger">{{ erros.email }}</span>

            <input v-model="pacienteSelecionado.telefone" type="text" class="form-control mb-2" placeholder="Telefone">
            <span v-if="erros.telefone" class="text-danger">{{ erros.telefone }}</span>

            <div class="d-flex justify-content-end gap-2">
                <button v-if="modoEdicao" class="btn btn-warning" @click="atualizarPaciente">Atualizar</button>
                <button v-else class="btn btn-success" @click="adicionarPaciente">Salvar</button>
                <button class="btn btn-secondary" @click="fecharFormulario">Cancelar</button>
            </div>
        </div>

        <!-- Tabela de Pacientes -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="paciente in pacientes" :key="paciente.id">
                    <td>{{ paciente.id }}</td>
                    <td>{{ paciente.nome }}</td>
                    <td>{{ paciente.email }}</td>
                    <td>{{ paciente.telefone }}</td>
                    <td>
                        <button class="btn btn-warning me-2" @click="editarPaciente(paciente)">Editar</button>
                        <button class="btn btn-danger" @click="deletarPaciente(paciente.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            pacientes: [],
            mostrarFormulario: false,
            modoEdicao: false,
            pacienteSelecionado: { id: null, nome: '', email: '', telefone: '' },
            erros: {} // Objeto para armazenar os erros de validação
        };
    },
    mounted() {
        this.carregarPacientes();
    },
    methods: {
        carregarPacientes() {
            axios.get('http://127.0.0.1:8000/api/pacientes')
                .then(response => this.pacientes = response.data)
                .catch(error => console.log(error));
        },
        abrirFormulario() {
            this.modoEdicao = false;
            this.pacienteSelecionado = { id: null, nome: '', email: '', telefone: '' };
            this.erros = {}; // Limpa os erros
            this.mostrarFormulario = true;
        },
        fecharFormulario() {
            this.mostrarFormulario = false;
            this.erros = {}; // Limpa os erros ao fechar o formulário
        },
        validarPaciente() {
            this.erros = {};
            let valido = true;

            if (!this.pacienteSelecionado.nome) {
                this.erros.nome = 'O nome é obrigatório';
                valido = false;
            }
            if (!this.pacienteSelecionado.email || !this.pacienteSelecionado.email.includes('@')) {
                this.erros.email = 'E-mail inválido';
                valido = false;
            }
            if (!this.pacienteSelecionado.telefone) {
                this.erros.telefone = 'O telefone é obrigatório';
                valido = false;
            }

            return valido;
        },
        adicionarPaciente() {
            if (!this.validarPaciente()) return;

            axios.post('http://127.0.0.1:8000/api/pacientes', this.pacienteSelecionado)
                .then(() => {
                    this.carregarPacientes();
                    this.fecharFormulario();
                })
                .catch(error => {
                    console.log(error);
                    this.erros.geral = 'Erro ao adicionar o paciente.';
                });
        },
        editarPaciente(paciente) {
            this.modoEdicao = true;
            this.pacienteSelecionado = { ...paciente };
            this.erros = {}; // Limpa os erros ao abrir para edição
            this.mostrarFormulario = true;
        },
        atualizarPaciente() {
            if (!this.validarPaciente()) return;

            axios.put(`http://127.0.0.1:8000/api/pacientes/${this.pacienteSelecionado.id}`, this.pacienteSelecionado)
                .then(() => {
                    this.carregarPacientes();
                    this.fecharFormulario();
                })
                .catch(error => {
                    console.log(error);
                    this.erros.geral = 'Erro ao atualizar o paciente.';
                });
        },
        deletarPaciente(id) {
            axios.delete(`http://127.0.0.1:8000/api/pacientes/${id}`)
                .then(() => this.carregarPacientes())
                .catch(error => {
                    console.log(error);
                    this.erros.geral = 'Erro ao excluir o paciente.';
                });
        }
    }
};
</script>
