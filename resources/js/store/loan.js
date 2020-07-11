import axios from 'axios'

export default {
    namespaced: true,

    state: {
        loans: [],
        loan: {},
        search: "",
        loaded: false
    },

    getters: {
        loan (state) {
            return state.loan
        },

        loans (state) {
            return state.loans
        },

        search (state) {
            return state.search;
        },

        loaded (state) {
            return state.loaded;
        }
    },

    mutations: {

        SET_LOAN (state, value) {
            state.loan = value;
        },

        SET_LOADED (state, value) {
            state.loaded = value;
        },

        SET_LOANS (state, value) {
            state.loads = value;
        },

        SET_SEARCH (state, value) {
            state.search = value;
        }
    },

    actions: {
       async saveLoan ({ commit }, loan) {
            await axios.post('api/loans', loan);
        },

        async updateClient ({ commit }, loan) {
           await axios.put('api/loans/' + loan.id, loan);
        },

        async getLoan ({ commit }, client) {
          let response = await axios.get('api/loans/' + client);

            commit('SET_LOAN', response.data.loan);
            commit('SET_LOADED', true);
        },

        async updateSeach ({ commit }, search) {
            commit('SET_SEARCH', search);
        },

        async getLoans ({ commit, state }) {
           let response = await axios.get('api/loans?search=' + state.search);
           commit('SET_LOANS', response.data.data);
        }
    }
}
