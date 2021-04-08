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
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
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
            <form>
              <div class="form-group">
                <label for="name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="name" />
              </div>
              <div class="form-group">
                <label for="email" class="col-form-label">email:</label>
                <input class="form-control" id="email"></input>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  mounted() {
    console.log("Component mounted modal.");
  },
  data: function () {
    return {
      contacts: "",
    };
  },

  methods: {},
};
</script>