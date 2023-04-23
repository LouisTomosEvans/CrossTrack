<template>
  <div>
    <v-overlay :value="overlay" opacity="1" :color="appStore.primary_color">
      <div class="text-center" width="50%">
        <!-- add logo -->
        <!-- <div>
          <img :src="appStore.logoWhite" width="150px">
        </div> -->

        <div class="text-center mt-4">
          <!-- <v-progress-linear rounded height="3" indeterminate color="white"></v-progress-linear> -->
          <v-progress-circular indeterminate color="white" size="50"></v-progress-circular>
        </div>
        

      </div>
    </v-overlay>
  </div>
</template>

<script>
import { useAppStore } from '../store/appStore';

export default {
  setup() {
    const appStore = useAppStore();
    return {
      appStore,
    };
  },
  name: "LoadingScreen",
  data: () => ({
      overlay: false,
  }),
  created() {
      this.loadSpinner();
  },
  methods: {
    loadSpinner(){
      this.overlay = !this.overlay;
    }
  },
  watch: {
      overlay (val) {
        val && setTimeout(() => {
          this.overlay = false
        }, 750)
    },
  },
};
</script>

<style scoped>
</style>
