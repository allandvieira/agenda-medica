import { createApp } from 'vue';
import Dashboard from '@/components/Dashboard.vue';
import Pacientes from '@/components/Pacientes.vue';
import 'bootstrap/dist/css/bootstrap.min.css';

const app = createApp({
    data() {
        return {
            paginaAtual: 'Dashboard'
        };
    },
    components: { Dashboard, Pacientes },
    methods: {
        navegar(pagina) {
            this.paginaAtual = pagina;
        }
    }
});

app.mount('#app');
