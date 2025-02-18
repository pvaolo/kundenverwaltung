<template>
  <div class="fullscreen bg-blue text-white text-center q-pa-md flex flex-center">
    <div>
      <div style="font-size: 30vh">
        404
      </div>
      <div class="text-h2" style="opacity:.4">
        Oops. Nothing here...
      </div>
      <div class="q-mt-md">
        <q-btn
          flat
          color="white"
          text-color="blue"
          unelevated
          to="/"
          label="Go Home"
          no-caps
          class="q-mr-sm"
        />
        <q-btn
          flat
          color="white"
          text-color="blue"
          unelevated
          @click="goBack"
          label="Go Back"
          no-caps
        />
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  name: 'Error404',
  setup() {
    const router = useRouter();

    const goBack = () => {
      router.back();
    };

    return { goBack };
  }
});
</script>

<style scoped>
.fullscreen {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #1e88e5; /* Blue background */
}

.text-white {
  color: #ffffff;
}

.q-btn {
  border-radius: 8px; /* Softer button corners */
}
</style>
