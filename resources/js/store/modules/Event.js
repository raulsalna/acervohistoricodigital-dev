const state = {
    eventId:null,
};

const mutations = {
    eventId(state,data){
        state.eventId = data;
    }
};

const actions = {

    eventId({commit}, data){
        commit('eventId', data);
    }
};

const getters = {
    eventId : state => state.eventId
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
