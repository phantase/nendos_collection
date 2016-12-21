        <!-- Menu -->
          <nav id="menu">
            <h2>Menu</h2>
            <ul>
              <li><a href="./home">Home</a></li>
<?php if(isEditor()){ ?>
              <li><a href="./addbox">Add a Box</a></li>
<?php } ?>
<?php if(isLogged()){ ?>
              <li><a href="./addphoto">Add a Photo</a></li>
<?php } ?>
              <li><a href="./boxes">Boxes</a></li>
              <li><a href="./nendoroids">Nendoroids</a></li>
              <li><a href="./faces">Faces</a></li>
              <li><a href="./hairs">Hairs</a></li>
              <li><a href="./hands">Hands</a></li>
              <li><a href="./bodyparts">Body Parts</a></li>
              <li><a href="./accessories">Accessories</a></li>
              <li><a href="./credits">Credits</a></li>
<?php if(isAdministrator()){ ?>
              <li><a href="./users">Users</a></li>
              <li><a href="elements.html">Elements</a></li>
<?php } ?>
            </ul>
          </nav>
