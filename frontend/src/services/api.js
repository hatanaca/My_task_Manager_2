import axios from 'axios';

// Configuração global do axios
const api = axios.create({
  baseURL: 'http://localhost:9000/api', // Defina a URL base do seu backend
  headers: {
    'Content-Type': 'application/json',
  },
});

export default api;

