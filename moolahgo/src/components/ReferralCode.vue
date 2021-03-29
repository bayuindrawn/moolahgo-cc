<template>
  <v-container>
    <v-dialog
      v-model="dialogLoading"
      fullscreen
      persistent
    >
      <v-container
        style="background-color: rgba(0, 0, 0, 0.5);"
        justify-space-between
        fluid
        fill-height
      >
        <v-layout 
          justify-center 
          align-center
          row 
        >
          <v-progress-circular
            indeterminate
            color="white"
            :size="50"
            :width="5"
          ></v-progress-circular>
        </v-layout>
      </v-container>
    </v-dialog>

    <v-card 
      class="mx-auto my-12"
      max-width="411"
    >
      <validation-observer ref="observer" v-slot="{ invalid }">
        <template slot="progress">
          <v-progress-linear
            color="deep-purple"
            height="10"
            indeterminate
          ></v-progress-linear>
        </template>
        <v-card-title 
          class="headline white--text"
          style="background-color: cadetblue;">
          Moolah Go Code Challange
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form class="form">
              <validation-provider
                v-slot="{ errors }"
                name="Refferal Code"
                rules="required|alpha_num|max:6|min:6"
              >
                <v-text-field
                label="Referral Code"
                v-model="referral_code"
                :error-messages="errors"
                @keyup="uppercase"
                required
                :maxlength="max"
                ></v-text-field>
              </validation-provider>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions
          justify-center 
          align-center
          style="margin-top:-40px"
        >
          <v-btn
            class="white--text"
            color="success"
            elevation="2"
            @click="searchReferral"
            :disabled="invalid"
          >
            Submit
          </v-btn>
          <v-btn @click="clear">Clear</v-btn>
        </v-card-actions>
      </validation-observer>
    </v-card>

    <v-dialog 
      v-model="dialogResult" 
      width="500">
      <v-card>
        <v-card-title 
          class="headline lighten-2 white--text"
          style="background-color: cadetblue;">
          Referral Code Owner Information
        </v-card-title>

        <v-card-text>
          <v-alert
            v-if="!statusSuccess"
            border="right"
            colored-border
            type="error"
            elevation="2"
            class="mt-2"
          >
            {{error}}
          </v-alert>
          <v-container v-else fluid>
            <v-row 
              align="center"
              justify="center">
                <v-col>
                  <center>
                    <img class="avatar" :src="item.photo" />
                  </center>
                </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Referral Code</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.referral_code"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Name</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.name"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>User Name</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.username"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Email</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.email"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Phone</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.phone"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Address</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field
                  label=""
                  v-model="item.address"
                  readonly
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="dialogResult = false"
          >
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import axios from "axios";
import { required, alpha_num, max, min } from "vee-validate/dist/rules";
import { extend, ValidationObserver, ValidationProvider } from "vee-validate";

extend("required", {
  ...required,
  message: "{_field_} can not be empty",
});
extend("max", {
  ...max,
  message: "{_field_} may not be greater than {length} characters",
});
extend("min", {
  ...min,
  message: "{_field_} may not be less than {length} characters",
});
extend("alpha_num", {
  ...alpha_num,
  message: "{_field_} only contain alphanumeric",
});
export default {
  name: 'ReferralCode',
  components: {
    ValidationObserver,
    ValidationProvider,
  },
  data: () => ({
    dialogLoading: false,
    max: 6,
    referral_code: "",
    dialogResult: false,
    statusSuccess: false,
    item: [],
    error: "",
  }),
  methods: {
    uppercase() {
      this.referral_code = this.referral_code.toUpperCase();
    },

    searchReferral() {
      this.dialogLoading = true;
      const config = {
        headers: {
          "Content-Type": "application/json"
        }
      };
      const apiURL = localStorage.getItem("apiURL");
      const param = { 
        referral_code: this.referral_code 
      };

      axios
        .post(apiURL + `/process`, param, config)
        .then(response => {
          const error = response.data.data.error;
          const success = response.data.data.success;
          this.dialogResult = true;

          if (error) {
            this.statusSuccess = false;
            this.error = error;
          }
          
          if (success) {
            console.log(success)
            this.statusSuccess = true;
            this.item.referral_code = success.referral_code;
            this.item.name = success.name;
            this.item.username = success.username;
            this.item.email = success.email;
            this.item.phone = success.phone;
            this.item.address = success.address;
            this.item.photo = success.photo;
          }

          this.dialogLoading = false;
        })
        .catch(e => {
          console.log(e.response);
          this.dialogLoading = false;
        });
    },

    clear() {
      this.referral_code = "";
    }
  }
};
</script>

<style scoped>
#app {
  margin-top: 30px;
}
.form {
  margin-top: 20px;
  margin-bottom: 50px;
}

.avatar {
  border-radius: 100%;
  width: 120px;
  height: 120px;
  border: 2px solid rgb(255, 255, 255)
}
</style>