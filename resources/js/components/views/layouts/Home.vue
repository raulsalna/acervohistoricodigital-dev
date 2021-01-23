<template>
    <div>
        <el-container  v-loading.fullscreen.lock="status"
                       :element-loading-text="message"
                       element-loading-background="rgba(255, 255, 255, 0.75)">
            <el-header style="background-color: rgb(12, 35, 30);">
                <el-row type="flex" justify="space-between">

                    <el-col :span="2">
                        <img
                            src="/img/RELEX_VERTICAL.png"
                            class="logo-sre2"
                            alt="header"
                            style="margin-top: 8px; margin-left: 5px;">

                    </el-col>
                    <el-col :span="8">
                        <div class="header-title-home" @click="$router.push('/acervo')" style="cursor: pointer">
                            Acervo Histórico Digital <small>v 0.3.1</small>
                        </div>
                    </el-col>


                    <el-col :span="14">
                        <el-menu
                            :router="true"
                            mode="horizontal"
                            background-color="#0c231e"
                            text-color="#fff"
                            active-text-color="#fff">
                            <el-popover
                                placement="top-start"
                                width="200"
                                trigger="hover"
                                content="Cerrar sesión">
                                <el-menu-item
                                    index="#"
                                    class="border-menu-item"
                                    @click="logout"
                                    slot="reference"
                                    style="cursor:pointer;float: right">
                                    <i class="fas fa-sign-out-alt" style="color: whitesmoke"></i>
                                </el-menu-item>
                            </el-popover>
                            <el-popover
                                placement="top-start"
                                width="200"
                                trigger="hover"
                                :content="$store.state.user.fullname+'           ('+profileName+' '+$store.state.user.cat_transaction_id +')'">
                                <el-menu-item
                                    index="#"
                                    slot="reference"
                                    class="border-menu-item"
                                    style="cursor:pointer;float: right">
                                    <i class="fas fa-user" style="color: whitesmoke;"></i>
                                </el-menu-item>
                            </el-popover>
                            <el-menu-item
                                index="#"
                                class="border-menu-item"
                                style="float: right">
                                <i class="fas fa-calendar-alt" style="color: whitesmoke"></i>
                                <span>
                                    {{ date | moment('timezone', 'America/Mexico_City') | moment('DD/MM/YYYY h:mm a') }}
                                </span>
                            </el-menu-item>
                        </el-menu>
                    </el-col>
                </el-row>
            </el-header>
            <el-main>
                <el-card shadow="never">
                    <router-view></router-view>
                </el-card>
            </el-main>
        </el-container>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions, mapMutations } from "vuex";

    export default {
        data() {
            return {
                date: new Date(),
                notifications: [],
                profileName: '',

            };
        },

        computed: {
            ...mapGetters('loading', ['message','status']),
             urlMain() {
            return window.URL;
            }
        },
        created() {

            this.startLoading();
            let _this = this;

            /*axios.get('/api/count-notifications').then(response => {
                this.notifications = response.data.notifications;
            }).catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });*/

            setInterval(function(){
                _this.date = new Date();
            },60000);
            this.setProfile();
            this.stopLoading();
        },

        methods: {
            setProfile(){
                if(this.$store.state.user.profile === 1){
                    this.profileName = 'Administrador';
                } if(this.$store.state.user.profile === 2){
                    this.profileName = 'Capturista';
                } if(this.$store.state.user.profile === 3){
                    this.profileName = 'Validador';
                }
            },

            logout() {

                axios.post(this.urlMain+"/api/logout").then(response => {
                    if (response.data.authenticated === false) {
                        sessionStorage.removeItem("ACERVO_token");
                        sessionStorage.removeItem("ACERVO_token_expiration");
                        sessionStorage.removeItem("ACERVO_hash");
                        axios.defaults.headers.common = {
                            Authorization: "Bearer"
                        };

                        this.$store.commit('deleteUser');
                        this.$router.push("/acervo/ingresar");
                    } else {
                        this.$message({
                            type: "warning",
                            message: "No fue posible cerrar su sesión, inténtelo nuevamente."
                        });
                    }
                });
            },
        }
    }
</script>

<style scoped>
    .el-submenu__title {
        border-bottom: 2px solid #9D2438 !important;
    }

    .el-menu-item, .el-submenu__title {
        height: 60px !important;
    }

    .header-title-home {
        font-size: 24px;
        color: rgb(255, 255, 255);
        margin-top: 15px;
    }

    .el-button {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
        border-bottom: none;
        box-shadow: none;
        font-weight: bold;
    }

    .logo-sre2 {
        width: 80px;
        height: 50px;
        display: block;
    }

    .bannerMain {
        /*background-image:url('/img/login/sre_white.png');*/
        background-repeat: no-repeat;
        background-size: cover;
        width: 100% !important;
    }

    @media screen and ( min-height: 512px ) {
        /* Content */
        .bannerMain {
            height: calc(512px + 50px)
        }
    }

    @media screen and ( min-height: 640px ) {
        /* Content */
        .bannerMain {
            height: calc(640px + 50px)
        }
    }

    @media screen and ( min-height: 768px ) {
        /* Content */
        .bannerMain {
            height: calc(768px + 50px)
        }
    }

    @media screen and ( min-height: 896px) {
        /* Content */
        .bannerMain {
            height: calc(896px + 50px)
        }
    }

    @media screen and ( min-height: 912px ) {
        /* Content */
        .bannerMain {
            height: calc(912px + 50px)
        }
    }

    @media screen and ( min-height: 1024px ) {
        /* Content */
        .bannerMain {
            height: calc(1024px + 50px)
        }
    }

    @media screen and ( min-height: 1180px ) {
        /* Content */
        .bannerMain {
            height: calc(1180px + 50px)
        }
    }

    @media screen and ( min-height: 1280px ) {
        /* Content */
        .bannerMain {
            height: calc(1280px + 50px)
        }
    }

    .el-menu-item{

        border-bottom: none !important;
    }

    .el-menu-item:focus, .el-menu-item:hover {
        outline: 0;
        background-color: rgba(0, 0, 0, 0.2) !important;
    }

    .el-menu-item.border-menu-item.is-active {
        border-color: rgba(0, 0, 0, 0.1) !important;
    }

    .wabble-effect:nth-child(2n) {
        animation: keyframes1;
        animation-iteration-count: infinite;
        transform-origin: 50% 10%;
        animation-delay: -0.75s;
        animation-duration: .25s
    }

    .wabble-effect:nth-child(2n-1) {
        animation-name: keyframes2;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        transform-origin: 30% 5%;
        animation-delay: -0.75s;
        animation-duration: .25s
    }

    @keyframes keyframes1 {
        0% {
            transform: rotate(-1deg);
            animation-timing-function: ease-in;
        }
        50% {
            transform: rotate(1.5deg);
            animation-timing-function: ease-out;
        }
    }

    @keyframes keyframes2 {
        0% {
            transform: rotate(1deg);
            animation-timing-function: ease-in;
        }
        50% {
            transform: rotate(-1.5deg);
            animation-timing-function: ease-out;
        }
    }
</style>
