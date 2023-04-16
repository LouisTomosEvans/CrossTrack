import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useWebsiteStore = defineStore('website', {
    state: () => ({
        websites: [],
    }),
    getters: {
        getWebsites: (state) => state.websites,
    },
    actions: {
        async fetchWebsites(team_id) {
            const api_url = '/api/teams/websites/' + team_id;
            const response = await axios.get(api_url);
            this.websites = response.data;
        },
    },
})