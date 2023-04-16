import { defineStore } from 'pinia';
import axios from 'axios';

// You can name the return value of `defineStore()` anything you want,
// but it's best to use the name of the store and surround it with `use`
// and `Store` (e.g. `useUserStore`, `useCartStore`, `useProductStore`)
// the first argument is a unique id of the store across your application
export const useTeamStore = defineStore('team', {
    state: () => ({
        team: [],
        members: [],
        invites: [],
    }),
    getters: {
        getTeam: (state) => state.team,
    },
    actions: {
        async fetchTeam(team_id) {
            const api_url = 'api/teams/members/' + team_id;
            const response = await axios.get(api_url);
            this.team = response.data;
            this.sortMembers();
            this.sortInvites();
        },
        async sortMembers() {
            // members are not invites
            this.members = this.team.filter(member => member.type != 'invite');
        },
        async sortInvites() {
            // members are not invites
            this.invites = this.team.filter(member => member.type == 'invite');
        }
    },
})