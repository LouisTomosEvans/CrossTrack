import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useLeadStore = defineStore('lead', {
    state: () => ({
        leads: [],
        contacts: {},
    }),
    getters: {
        getLeads: (state) => state.leads,
    },
    actions: {
        async fetchLeads(team_id) {
            const api_url = 'api/teams/leads/' + team_id;
            const response = await axios.get(api_url);
            this.leads = response.data;
        },
        async fetchContacts(domain) {
            const api_url = 'api/contacts/';
            let payload = {
                domain: domain
            }
            const response = await axios.post(api_url, payload);
            // add contact to lead
            // go through each lead
            this.leads.forEach(lead => {
                // go through each contact
                if (domain === lead.domain) {
                    // add the contact to the lead
                    lead.contacts = response.data;
                }
            });
            this.contacts = response.data;
        }
    },
})