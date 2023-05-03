class Header extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
          <header align="center">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f2f2f2;">
              <div class="container-fluid">
                  <a class="navbar-brand" href="./FileManager.php">File Manager</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./HomePage.php">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./Profile.php">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="./Upload.php">Upload</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Feedback</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                      </li>
                  </ul>
                  <form action="../Authentication/SignIn.php" method="get" class="d-flex">
                    <button class="btn btn-outline-secondary" type="submit">Logout</button>
                  </form>
              </div>
            </nav>
          </div>
      </header>`;
  };
}

customElements.define('header-component', Header);

class Footer extends HTMLElement {
  constructor() {
    super();
  }

  connectedCallback() {
    this.innerHTML = `
          <style>
          .social-row {
            font-size: 20px;
          }
          
          .social-row li {
            margin: 0 15px;
          }
          ul li {
            list-style: none;
            display: inline;
          }
          input {
            float: left;
            padding: 10px;
            height: 75px;
            border-radius: 10px;
            margin: 0 0;
        }
          </style>
          <footer align="center">
            <ul class="social-row">
              <li><input title="Github" type="image" src="images/Github_Logo.png" alt="Github" onclick="github()" /></li>
              <li><input title="Instagram" type="image" src="images/instagram-logo.png" alt="Instagram" onclick="insta()" /></li>
              <li><input title="LinkedIn" type="image" src="images/linkedin-logo.png" alt="Linkedin" onclick="insta()" /></li>
            </ul>
          </footer>
        `;
  }
}

customElements.define('footer-component', Footer);