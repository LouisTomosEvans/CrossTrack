<template>
  <div>
    <v-overlay :value="overlay" opacity="1" color="#f05628">
      <div class="text-center" width="50%">
        <!-- add logo -->
        <div>
          <img src="brandAssets\whiteLogo.png" width="150px">
        </div>

        <div class="text-center mt-4">
          <v-progress-linear rounded height="3" indeterminate color="white"></v-progress-linear>
        </div>
        

      </div>
    </v-overlay>
  </div>
</template>

<script>
export default {
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
