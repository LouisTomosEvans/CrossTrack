import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useWebsiteStore = defineStore('website', {
    state: () => ({
        websites: [],
        trackingSnippet: "",
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
        async archiveWebsite(team_id, website_id) {
            const api_url = '/api/teams/websites/' + team_id + "/" + website_id;
            const response = await axios.put(api_url);
            // fetch the websites again
            this.fetchWebsites(team_id);
        },
        async unarchiveWebsite(team_id, website_id) {
            const api_url = '/api/teams/websites/' + team_id + "/" + website_id;
            const response = await axios.put(api_url);
            // fetch the websites again
            this.fetchWebsites(team_id);
        },
        async deleteWebsite(team_id, website_id) {
            const api_url = '/api/teams/websites/' + team_id + "/" + website_id;
            const response = await axios.delete(api_url);
            // fetch the websites again
            this.fetchWebsites(team_id);
        },
        async editWebsite(team_id, website_id, payload) {
            const api_url = '/api/teams/websites/' + team_id + "/" + website_id;
            const response = await axios.post(api_url, payload);
            // fetch the websites again
            this.fetchWebsites(team_id);
        },
        async addWebsite(team_id, payload) {
            const api_url = '/api/teams/websites/' + team_id;
            const response = await axios.post(api_url, payload);
            // fetch the websites again
            this.fetchWebsites(team_id);
            this.trackingSnippet = response.data.trackingSnippet;
        },
    },
})