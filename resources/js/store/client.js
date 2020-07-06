import axios from 'axios'

export default {
    namespaced: true,

    state: {
        clients: [],
        client: null
    },

    getters: {
        client (state) {
            return state.client
        },

        clients (state) {
            return state.clients
        },
    },

    mutations: {

        SET_CLIENT (state, value) {
            state.client = value;
        },

        SET_CLIENTS (state, value) {
            state.clients = value;
        }
    },

    actions: {
       async saveClient ({ commit }, client) {
            await axios.post('api/clients', client);
        },

        async updateClient ({ commit }, client) {
           await axios.put('api/clients/' + client.id);
        },

        async getClients({ commit }) {
           let response = await axios.get('api/clients');

           commit('SET_CLIENTS', response.data.clients);
        }
    }
}
