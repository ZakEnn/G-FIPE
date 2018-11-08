
import Formation from './components/Formation.vue';
import Management from './components/Management.vue';
import Dashboard from './components/Dashboard.vue';
import Store from './components/Store.vue';
import Sessions from './components/management/Sessions.vue';
import Agents from './components/management/Agents.vue';
import Tests from './components/management/Tests.vue';
import Formations from './components/management/Formations.vue';
import Content from './components/formation/Content.vue';

export const routes = [


    {path:'/dashboard',name :'dashboard',component: Dashboard ,props:true},

    {path:'/myStore',component: Store ,props:true},

    {path:'/management',component:Management,

        children:[
            {path:'sessions',name :'sessions',component: Sessions ,props:true},

            {path:'formations',component: Formations },

            {path:'agents',component: Agents },

            {path:'tests',component: Tests },


        ]
    },
    {path:'/formation',component: Formation,

        children:[
            {path:':id',component: Content ,props:true},
        ]
    },



    {path:'*',component:Dashboard}
];
