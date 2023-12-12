<div class="container">
    <h1 class="font-bold text-5xl">Order Status</h1>
    <br>
    <div class="status-container" >
      {{-- <div class="status-item" id="toPay">
        <div class="status-icon">
          <i class="bx bx-cart"></i>
        </div>
        <div class="status-text">To Pay</div>
      </div> --}}

      <div class="status-item" id="toReceive">
        <div class="status-icon">
          <i class="bx bxs-truck"></i>
        </div>
        <div class="status-text">To Receive</div>
      </div>

      <div class="status-item" id="complete">
        <div class="status-icon">
          <i class="bx bx-check"></i>
        </div>
        <div class="status-text">Completed</div>
      </div>

      <div class="status-item" id="toCancelled">
        <div class="status-icon">
          <i class="bx bx-x"></i>
        </div>
        <div class="status-text">Cancelled</div>
      </div>
    </div>
  </div>

<script>
    const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toggle");

    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>
  <script>
    document.querySelectorAll(".status-item").forEach((item) => {
      item.addEventListener("click", function () {
        // Get the id of the clicked status-item
        const id = this.getAttribute("id");

        // Determine the target URL based on the id
        let targetUrl = "";
        switch (id) {
          case "toPay":
            targetUrl = "/toPay";
            break;
          case "toShip":
            targetUrl = "/toShip";
            break;
          case "toReceive":
            targetUrl = "/toReceive";
            break;
          case "complete":
            targetUrl = "/completed";
            break;
          case "toCancelled":
            targetUrl = "/cancelled";
            break;
          default:
            // Handle default behavior or error
            break;
        }

        // Navigate to the target URL
        window.location.href = targetUrl;
      });
    });
  </script>