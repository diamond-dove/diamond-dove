import axios from 'axios'

export default {
    namespaced: true,

    state: {
        clients: [],
        client: {},
        search: "",
        loaded: false
    },

    getters: {
        client (state) {
            return state.client
        },

        clients (state) {
            return state.clients
        },

        search (state) {
            return state.search;
        },

        loaded (state) {
            return state.loaded;
        }
    },

    mutations: {

        SET_CLIENT (state, value) {
            state.client = value;
        },

        SET_LOADED (state, value) {
            state.loaded = value;
        },

        SET_CLIENTS (state, value) {
            state.clients = value;
        },

        SET_SEARCH (state, value) {
            state.search = value;
        }
    },

    actions: {
       async saveClient ({ commit }, client) {
            await axios.post('api/clients', client);
        },

        async updateClient ({ commit }, client) {
           await axios.put('api/clients/' + client.id, client);
        },

        async getClient ({ commit }, client) {
          let response = await axios.get('api/clients/' + client);

            commit('SET_CLIENT', response.data.client);
            commit('SET_LOADED', true);
        },

        async updateSeach ({ commit }, search) {
            commit('SET_SEARCH', search);
        },

        async getClients({ commit, state }) {
           let response = await axios.get('api/clients?search=' + state.search);
           commit('SET_CLIENTS', response.data.data);
        }
    }
}
