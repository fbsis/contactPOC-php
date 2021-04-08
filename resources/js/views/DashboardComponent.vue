<script>
import ModalFormComponent from "./ModalFormComponent.vue";
import ContactsService from "../services/Contacts";

export default {
  components: { ModalFormComponent },
  mounted() {
    this.getContacts();
  },
  data: function () {
    return {
      contacts: [],
    };
  },

  methods: {
    getContacts: function (e) {
      let self = this;
      ContactsService.getAll().then(function (response) {
        console.log(response);
        self.contacts = response.data.data;
      });
    },
    removeContact: function (e) {
      let self = this;
      ContactsService.remove(e.id).then(function (response) {
        self.getContacts();
      });
    },
  },
};
</script>

<template>
  <div>
    <button
      type="button"
      class="btn btn-outline-primary"
      data-toggle="modal"
      data-target="#modalContact"
    >
      Add new Contact
    </button>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">email</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id">
          <th scope="row">{{ contact.name }}</th>
          <td>{{ contact.email }}</td>
          <td>
            <button
              type="button"
              class="btn btn-primary"
              v-on:click="removeContact(contact)"
            >
              Remove
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <modal-form-component />
  </div>
</template>

<style scoped>
input {
  margin-bottom: 10px;
}
table.table {
  margin-top: 10px;
}
</style>