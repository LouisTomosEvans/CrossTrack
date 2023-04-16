import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useUserStore = defineStore('user', {
    state: () => ({
        user: "",
    }),
    getters: {
        getUser: (state) => state.user,
    },
    actions: {
        async fetchUser() {
            const api_url = '/api/app';
            const response = await axios.get(api_url);
            this.user = response.data[0];
        },
    },
})