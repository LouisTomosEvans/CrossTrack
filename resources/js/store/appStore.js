import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useAppStore = defineStore('app', {
    state: () => ({
        logo: "",
        mark: "",
        primary_color: "",
        colorIndex: 0,
        // rainbow colors
        colorArray: ['#f05628', '#f0a428', '#f0f428', '#a4f428', '#28f0f4', '#284df0', '#a428f0'],
        // dashboard data
        dashboardData: [],
        tags: [],
        locale: 'en',
    }),
    actions: {
        async setBranding() {
            this.logo = 'brandAssets/Logo.png';
            this.mark = 'brandAssets/Mark.svg';
            // f05628
            this.primary_color = '#f05628';
        },
        async setDashboardData(team_id) {
            const api_url = 'api/teams/dashboard/' + team_id;
            const response = await axios.get(api_url);
            this.dashboardData = response.data;
            // go through dashboardData - get visits_this_month and convert to zero arrray of length of days in this month
        },
        getTeamTags(team_id) {
            const api_url = 'api/teams/tags/' + team_id;
            axios.get(api_url).then(response => {
                this.tags = response.data;
            });
        },
    },
})