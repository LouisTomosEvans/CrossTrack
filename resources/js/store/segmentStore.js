import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useSegmentStore = defineStore('segment', {
    state: () => ({
        segments: [],
    }),
    getters: {
        getSegments: (state) => state.segments,
    },
    actions: {
        async fetchSegments(team_id) {
            const api_url = '/api/teams/segments/';
            const response = await axios.get(api_url);
            this.segments = response.data;
        },
    },
})