<template>
  <div>
    <div
      class="modal fade"
      id="modalConfig"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalConfigLabel"
      aria-hidden="true"
    >
      <form @submit="save">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Configuration</h5>
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
                <label for="name" class="col-form-label">E-mail to be sent on delete:</label>
                <input
                  type="text"
                  class="form-control"
                  required
                  autofocus
                  v-model="name"
                />
              </div>
              
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Discard
              </button>
              <button type="submit" class="btn btn-primary">
                Save Configuration
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
    save: function (e) {
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