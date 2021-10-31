import {createStore} from 'vuex'
import {Howler} from 'howler'

export const store = createStore({
  state() {
    playList: new Map();
    Howler
  },
  mutations: {
    addSound(state) {
    }
  },
  actions: {

  },
  getters: {

  },
});
