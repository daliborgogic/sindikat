import Vuex from 'vuex'

const createStore = () => {
  return new Vuex.Store({
    state: () => ({
      online: true
    }),
    mutations: {
      connection: (state, value) => state.online = value
    }
  })
}

export default createStore
