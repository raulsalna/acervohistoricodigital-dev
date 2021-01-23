export default {
    methods: {
        startLoading() {
            return this.$store.dispatch(
                'loading/spinner', {msg: 'Cargando Datos...', status: true}, {root: true});
        },

        stopLoading() {
            return this.$store.dispatch('loading/spinner', {}, {root: true});
        },

        showLoading: function showLoading(msg) {
            var msgLetter = "Cargando Datos...";
      
            if (msg) {
              msgLetter = msg;
            }
      
            this.$store.dispatch("loading/spinner", {
              msg: msgLetter,
              status: true
            }, {
              root: true
            });
          },
    },
};
