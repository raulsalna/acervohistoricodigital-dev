import {getIPs, getIPv4, getIPv6} from 'webrtc-ips';

// Initial state
const state = {
    mask				: null,
    hash_id				: null,
    fullname			: null,
    name				: null,
    firstName			: null,
    secondName			: null,
    profile				: null,
    cat_user_type_id	: null,
    cat_unity_id		: null,
    cat_area_id			: null,
    cat_department_id	: null,
    cat_office_id		: null,
    isaAdministrativeCoordinator	: null,
    adminCoordinatorChanger 		: null,
    isResponsible		: null,
    informationUpdated	: null,
    needUpdatePass		: false,
    sem_user_id			: null,
    isValidator			: null,
    cat_transaction_id   :   null,
    isSee:null,
    isEdit:null,
    isRemove:null,

};

// Getters
const getters = {

};

// Actions
const actions = {
    getUserInfo({dispatch, commit}){
        return new Promise((resolve, reject) => {
            // Action to fix sesion user information if window browser is refreshed.
            if ( window.sessionStorage.getItem("ACERVO_token") ) {
                dispatch('getUserIP')
                    .then(()  => { resolve() })
                    .catch(() => { reject() });
            } else {
                // dispatch('logout');
                commit('deleteUser');
                reject();
            }
        });
    },
    sessionInfo({dispatch, commit}, ip){

        return new Promise( (resolve, reject) => {
            axios.get("/acervo/api/user/" + window.sessionStorage.getItem("ACERVO_hash"), { params: { ip: ip } })
                .then(response => {
                    commit("setUser", response.data.user);
                    resolve();
                })
                .catch(error => {
                    // dispatch('logout');
                    commit('deleteUser');
                    reject();
                });
        });

    },
    logout(){
        sessionStorage.removeItem("ACERVO_token");
        sessionStorage.removeItem("ACERVO_token_expiration");
        sessionStorage.removeItem("ACERVO_hash");

        axios.defaults.headers.common = {
            'Authorization': 'Bearer'
        };
    },
    getUserIP({dispatch, commit}) {

        return new Promise( (resolve, reject) => {

            getIPs()
                .then(ip => {
                    dispatch('sessionInfo', ip)
                        .then(()  => { resolve() })
                        .catch(() => { reject() });
                })
                .catch((error) => { reject() });

        });

    }
};

// Mutations
const mutations = {
    setUser: (state, user) => {
        state.mask				= user.mask;
        state.hash_id			= user.hash_id;
        state.fullname			= user.fullname;
        state.name				= user.name;
        state.firstName			= user.firstName;
        state.secondName		= user.secondName;
        state.profile			= user.profile;
        state.cat_user_type_id	= user.cat_user_type_id;
        state.cat_unity_id		= Number(user.cat_unity_id);
        state.isaAdministrativeCoordinator	= Boolean(user.isaAdministrativeCoordinator);
        state.adminCoordinatorChanger		= Boolean(user.adminCoordinatorChanger);
        state.sem_user_id		= user.sem_user_id;
        state.isValidator		= user.isValidator;
        state.cat_transaction_id = user.cat_transaction_id;
    },
    setPasswordUpdated: state => {
        state.needUpdatePass = false;
    },
    deleteUser: state => {
        state.mask				= null;
        state.hash_id			= null;
        state.fullname			= null;
        state.name				= null;
        state.firstName			= null;
        state.secondName		= null;
        state.profile			= null;
        state.cat_user_type_id	= null;
        state.isaAdministrativeCoordinator		= null;
        state.adminCoordinatorChanger			= null;
        state.isResponsible			= null;
        state.informationUpdated	= null;
        state.needUpdatePass		= false;
        state.sem_user_id			= null;
        state.isValidator			= null;
        state.cat_transaction_id = null;

    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
