<template>
  <div>
    <div
      class="modal fade"
      id="modalContact"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalContactLabel"
      aria-hidden="true"
    >
      <form @submit="saveContact">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add new contact</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="name" class="col-form-label">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  autofocus
                  v-model="name"
                />
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">email:</label>
                <input
                  type="email"
                  class="form-control"
                  required
                  v-model="email"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary">
                Save changes
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>


<script>
import ContactsService from "../services/Contacts";

export default {
  mounted() {
    console.log("Component mounted modal.");
  },
  data: function () {
    return {
      modalShow: true,
      contacts: "",
      name: "",
      email: "",
    };
  },

  methods: {
    saveContact: function (e) {
      self = this;
      ContactsService.create({
        name: this.name,
        email: this.email,
      }).then(function (response) {
        self.name = "";
        self.email = "";
        $('#modalContact').modal('hide');
        self.$emit('created');

      });
      e.preventDefault();
    },
  },
};
</script>