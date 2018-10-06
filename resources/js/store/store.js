import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state : {
        session_declined:[],
        session_presence:[],
        session_approved:[],
    },

    getters:{
      //
    },

    mutations:{
        // increment: (state,item) =>{
        //   state.session_declined = state.session_declined.push(item);
        //  },

    }

})