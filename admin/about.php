<?php 
  session_start();
  
  if(!isset($_SESSION['id'])){
        header('location:../login.php');
        exit;
    }
  
  include '../config/config.php';
    class data extends Connection { 
      public function managedata(){ 
?>
<!DOCTYPE html>
<html>
<head><?php include 'head.php'; ?>

<style>
    .welcome-header {
    background-color: #3C8DBC;
    color: white;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: -1rem;
}

.welcome-header img {
    margin-top: -1.5rem;
    width: 8rem;
}

.welcome-header span {
    font-weight: 300;
    letter-spacing: 1.3rem;
    font-size: 1.3rem;
    text-align: center;
    line-height: 3.4rem;
}

.welcome-header span:last-of-type {
    font-weight: 600;
    font-size: 2.5rem;
    letter-spacing: 1.2rem;
}

p {
    margin: 0;
}

.description {
    display: flex;
    flex-direction: column;
    text-align: justify;
}

.desc {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    text-indent: 4rem;
    position: relative;
    overflow: hidden;
    padding: 3rem;
    z-index: 5;
    align-items: center;
    box-shadow: 0 8px 10px rgba(0, 0, 0, 0.1);
}

.desc p {
    max-width: 800px;
}

.desc .header {
    margin-top: -1rem;
}

.desc img {
    max-width: 800px;
}

.features {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #3C8DBC;
}

.features .semi-title {
    color: white;
    font-weight: 300;
    letter-spacing: 1.3rem;
    font-size: 1.3rem;
    text-align: center;
    margin: 1rem 0 -1rem 0;
}

.features .key-title {
    color: white;
    font-weight: 600;
    font-size: 2.5rem;
    letter-spacing: 1rem;
    padding: 0.5rem 1rem;
    margin-top: 0.5rem;
}

/* .features .bg-img {
    width: 100%;
    height: 100%;
    position: absolute;
    object-fit: cover;
    z-index: -1;
    opacity: 0.85;
} */

.cards-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
    align-items: center;
    padding: 0 4rem 2rem 4rem;
    margin-top: 1rem;
}

.card {
    width: 12rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 1.5rem;
    background-color: #fff;
    height: 18.5rem;
    gap: 0.5rem;
    border-radius: 0.45rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    cursor: pointer;
    height: 250px;
    width: 200px;

    &:hover {
        transform: scale(1.02) translateY(-0.75em);
        transition-duration: 300ms;
        transition-timing-function: ease-in-out;
    }
}

.card span {
    font-weight: 600;
    font-size: 1.5rem;
    text-align: center;
    pointer-events: none;
    margin: 0;
}

.card p {
    margin: 0;
    font-size: 1.3rem;
    pointer-events: none;
}

.card img {
    height: 8rem;
    max-width: 10rem;
    object-fit: contain;
    pointer-events: none;
}

.core {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 3rem;
}

.core img {
    max-width: 800px;
}

.semi-header {
    font-weight: 300;
    letter-spacing: 1.3rem;
    font-size: 1.3rem;
    text-align: center;
}

.header {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    letter-spacing: 1rem;
}

.last-paragraph {
    margin-top: 2rem;
    align-self: center;
    text-indent: 4rem;
    max-width: 800px;
}

.dev-container {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
    background-color: #3C8DBC;
}

.dev-semi-header {
    color: white;
    font-weight: 300;
    letter-spacing: 1.3rem;
    font-size: 1.3rem;
    text-align: center;
    margin: 1rem 0 -1rem 0;
}

.dev-header {
    color: white;
    text-align: center;
    font-size: 2.5rem;
    font-weight: 600;
    letter-spacing: 1rem;
}

.row-of-devs {
    display: flex;
    align-items: center;
    gap: 3rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.dev-img {
    height: 13rem;
    width: 13rem;
    border-radius: 0.3rem;
}

.developer-details {
    background-color: #fff;
    padding: 1rem 1rem 0.5rem 1rem;
    border-radius: 0.3rem;
    position: relative;
    text-decoration: none;
    color: black;

    &:hover {
        transform: scale(1.02) translateY(-0.75em);
        transition-duration: 300ms;
        transition-timing-function: ease-in-out;
    }
}

.developer-details .wave {
    position: absolute;
    top: -2.5rem;
    left: -2.5rem;
    z-index: 5;
    font-size: 4rem;
    animation-name: wave;
    animation-duration: 1s;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
}

.developer-details p {
    font-weight: 600;
    font-size: 1.1rem;
    text-align: center;
}

@keyframes wave {
    0% {
        transform: rotate(-10deg);
    }

    50% {
        transform: rotate(10deg);
    }

    100% {
        transform: rotate(-10deg);
    }
}

.feature-desc {
    font-size: 20px;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <?php include 'profile.php'; ?>
  <?php include 'sidebar.php'; ?>
    <div class="content-wrapper" style="height: 100vh;background-color: #f9f9f9;overflow-y: auto;">
      <section class="content">
        <div class="welcome-header">
            <img src="thesishub_logo2.png" alt="">
            <span>WELCOME TO</span>
            <span>DLSU-D THESIS TRACKER</span>
        </div>
        <div class="description">
            <div class="desc">
                <span class="semi-header">WHAT IS IT</span>
                <span class="header">ALL ABOUT</span>
                <img src="tracker.jpg" alt="">
                <p>DLSU-D Tracker is a dedicated platform created for the Computer Science and IT Department of De La Salle University - Dasmariñas (DLSU-D). Our mission is to streamline the thesis process for students, advisers, and department staff, ensuring a smooth and efficient journey from project proposal to final defense.</p>
                <p>Developed with the specific needs of Computer Science and IT students in mind, this platform provides a centralized space where students can track their progress, collaborate with their thesis advisers, and meet important deadlines. Whether you are just starting your thesis or finalizing your documentation, the Thesis Tracker helps simplify and organize the entire process.</p>
            </div>
            <div class="features">
                <span class="semi-title">HERE ARE ITS</span>
                <span class="key-title">KEY FEATURES</span>
                <div class="cards-container">
                    <div class="card">
                        <div class="img-container">
                            <img src="../images/milestone.png" alt="milestone">
                        </div>
                        <span class="title">Milestone Tracking</span>
                        <p class="feature-desc">Easily follow key deadlines and submission dates for proposals, drafts, revisions, and defenses.</p>
                    </div>
                    <div class="card">
                        <div class="img-container">
                            <img src="../images/rts.jpg" alt="milestone">
                        </div>
                        <span class="title">Real-Time Updates</span>
                        <p class="feature-desc">Stay updated on the status of your thesis, including feedback and approvals from your adviser and the faculty.</p>
                    </div>
                    <div class="card">
                        <div class="img-container">
                            <img src="../images/docsub.png" alt="milestone">
                        </div>
                        <span class="title">Document Submission</span>
                        <p class="feature-desc">Upload, review, and submit your thesis drafts, proposals, and final copies securely and efficiently.</p>
                    </div>
                    <div class="card">
                        <div class="img-container">
                            <img src="../images/progress.jpg" alt="milestone">
                        </div>
                        <span class="title">Progress Dashboard</span>
                        <p class="feature-desc">A clear and interactive dashboard showing your thesis' current status and what's left to accomplish.</p>
                    </div>
                </div>
            </div>
            <div class="core">
                <span class="semi-header">AT ITS</span>
                <span class="header">CORE FUNCTION</span>
                <img src="tool.jpg" alt="">
                <p class="last-paragraph">At the core of Thesis Tracker is our commitment to fostering a seamless academic experience, empowering students and faculty with the right tools to collaborate effectively. By reducing manual paperwork and simplifying workflows, our goal is to help students focus more on their research and innovation, rather than administrative hurdles. This platform reflects our dedication to academic excellence, innovation, and continuous improvement within the Computer Science and IT Department at DLSU-D.</p>
            </div>    
        </div>      
        <div class="dev-container">
            <span class="dev-semi-header">MEET THE</span>
            <span class="dev-header">DEVELOPERS</span>
            <div class="row-of-devs" style="display: flex; justify-content: space-around">
                <a class="developer-details" href="https://www.linkedin.com/in/chester-gulmatico-0b2712259" target="_blank">
                    <span class="wave">👋</span>
                    <img src="../images/chester.jpg" class="dev-img">
                    <p>Chester Gulmatico</p>
                </a>
                <a class="developer-details" href="https://www.linkedin.com/in/alex-francis-gecto" target="_blank">
                    <span class="wave">👋</span>
                    <img src="../images/alex.jpg" class="dev-img">
                    <p>Alex Francis Gecto</p>
                </a>
                <a class="developer-details" href="https://https://www.linkedin.com/in/allen-jhayvee-sabater-8260b1264/" target="_blank">
                    <span class="wave">👋</span>
                    <img src="../images/allen.jpg" class="dev-img">
                    <p>Allen Jhayvee Sabater</p>
                </a>
            </div>
        </div>
      </section>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php } } $data = new data(); $data->managedata(); ?>