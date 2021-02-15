import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/',        component: require('./components/pages/Home.vue').default },
    { path: '/home',    component: require('./components/pages/Home.vue').default },
    { path: '/friend',  component: require('./components/pages/Friend.vue').default },
    { path: '/group',   component: require('./components/pages/Group.vue').default },
    { path: '/group/:groupId', component: require('./components/group/content/Content.vue').default },
    { path: '/friend/:friendId',  component: require('./components/friend/content/Content.vue').default },
    { path: '/profile', component: require('./components/pages/Profile.vue').default },
    { path: '/setting', component: require('./components/pages/Setting.vue').default },
    { path: '/tracking', component: require('./components/pages/Tracking.vue').default },

    // { path: '/tracking', component: require('./components/pages/Tracking.vue').default },
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
})

export default router;