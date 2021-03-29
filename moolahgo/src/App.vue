<template>
  <v-app>
    <v-main>
      <ReferralCode msg="Moolah Go Code Challange"/>
    </v-main>
  </v-app>
</template>

<script>
import ReferralCode from './components/ReferralCode';

export default {
  name: 'App',

  components: {
    ReferralCode,
  },

  data: () => ({
    //
  }),
};
</script>
