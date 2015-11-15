<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
//require_once('@vendor/opendata/opendata.php');

$this->title = 'Οδηγίες Χρήσης';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
            <div style="text-align: justify;" class="col-lg-10">
  <div id="wiki-wrapper" class="wiki-wrapper page">

<div id="wiki-content">
  <div class="wrap has-rightbar">

  <div id="wiki-rightbar">
    <div class="wiki-pages-box readability-sidebar boxed-group flush js-wiki-pages-box " role="navigation">
      
  <div id="wiki-body" class="gollum-markdown-content instapaper_body">
    <div class="markdown-body">
      <p>Οδηγίες για Τελικούς Χρήστες</p>

<h1>
<a id="user-content-Προαπαιτούμενα" class="anchor" href="#%CE%A0%CF%81%CE%BF%CE%B1%CF%80%CE%B1%CE%B9%CF%84%CE%BF%CF%8D%CE%BC%CE%B5%CE%BD%CE%B1" aria-hidden="true"><span class="octicon octicon-link"></span></a>Προαπαιτούμενα</h1>

<p>Για να μπορέσετε να εγκαταστήσετε την εφαρμογής <em>DiavgeiaInsight</em> είναι απαραίτητα τα εξής :</p>

<ul>
<li><p>Web Server (Apache, IIS, Nginx)</p></li>
<li><p>Η γλώσσα προγραμματισμού PHP</p></li>
<li><p>Σύστημα Διαχερίσης Βάσης Δεδομένων MySQL/MariaDB.</p></li>
</ul>

<p>Εφόσον δεν υπάρχει κάποιο από τα παραπάνω, μπορείτε είτε να τα εγκαταστήσετε μεμονομένα, είτε να κατεβάσετε ένα από τα *AMP πακέτα που κυκλοφορούν, όπως το XAMPP (<a href="https://www.apachefriends.org/index.html">https://www.apachefriends.org/index.html</a>) ή το WAMP (<a href="https://bitnami.com/">https://bitnami.com/</a>).</p>

<h3>
<a id="user-content-Ρυθμίσεις-php" class="anchor" href="#%CE%A1%CF%85%CE%B8%CE%BC%CE%AF%CF%83%CE%B5%CE%B9%CF%82-php" aria-hidden="true"><span class="octicon octicon-link"></span></a>Ρυθμίσεις PHP</h3>

<p>Επειδή κάποιες από τις εργασίες που γίνονται στην εφαρμογή, όπως η ενημέρωση των αποφάσεων από τη Διαύγεια, είναι χρονοβόρες, θα χρειαστεί να τροποποιήσουμε δύο (2) παραμέτρους στο αρχείο ρυθμίσεων της PHP (php.ini).</p>

<ul>
<li><p>max_execution_time : Προτίνεται ο ορισμός μιας αρκετά μεγάλης τιμής (&gt;600sec).</p></li>
<li><p>memory_limit : Χρειάζεται να οριστεί σε τιμή &gt;1024Μ.</p></li>
</ul>

<p>Οι τιμές αυτές είναι μόνο για την περίπτωση της αρχικής ενημέρωσης μέσω του API της Διαύγειας, μπορείτε δηλαδή να τις επαναφέρετε στην αρχική τους κατάσταση.</p>

<p><strong>ΠΡΟΣΟΧΗ :</strong> Μετά την τροποποίηση και για να περαστεί η αλλαγή στο σύστημα, θα πρέπει να επανεκκινήσετε τον Web Server.</p>

<h1>
<a id="user-content-Εγκατάσταση" class="anchor" href="#%CE%95%CE%B3%CE%BA%CE%B1%CF%84%CE%AC%CF%83%CF%84%CE%B1%CF%83%CE%B7" aria-hidden="true"><span class="octicon octicon-link"></span></a>Εγκατάσταση</h1>

<p>Το αρχείο εγκατάστασης μπορείτε να το βρείτε στο repository του Github (<a href="https://github.com/ellak-monades-aristeias/DiavgeiaInsights">https://github.com/ellak-monades-aristeias/DiavgeiaInsights</a>), πατώντας στην επιλογή '<em>Download ZIP</em>'.</p>

<p>Στα βασικά του περιεχόμενα είναι οι εξής κατάλογοι :</p>

<ul>
<li><p><strong>basic</strong> : Περιέχει τα PHP αρχεία για το Web Server.</p></li>
<li><p><strong>PE1_DB</strong> : Περιέχει τα SQL με τον σκελετό και δοκιμαστικά δεδομένα για να λειτουργήσει η εφαρμογή.</p></li>
<li><p><strong>PE4_Manuals</strong> : Περιέχει ενημερωμένες οδηγίες χρήσης και υλικό παρουσίασης.</p></li>
</ul>

<h3>
<a id="user-content-web-αρχεία" class="anchor" href="#web-%CE%B1%CF%81%CF%87%CE%B5%CE%AF%CE%B1" aria-hidden="true"><span class="octicon octicon-link"></span></a>Web αρχεία</h3>

<p>Τοποθετείστε τον κατάλογο <strong>basic</strong> στο root κατάλογο του Web Server (π.χ. htdocs).</p>

<h3>
<a id="user-content-Βάση-Δεδομένων" class="anchor" href="#%CE%92%CE%AC%CF%83%CE%B7-%CE%94%CE%B5%CE%B4%CE%BF%CE%BC%CE%AD%CE%BD%CF%89%CE%BD" aria-hidden="true"><span class="octicon octicon-link"></span></a>Βάση Δεδομένων</h3>

<p>Από τον κατάλογο <strong>PE1_DB</strong>, χρησιμοποιούμε το αρχείο diavgeiainsights.sql (<a href="https://github.com/ellak-monades-aristeias/DiavgeiaInsights/blob/master/PE1_DB/diavgeiainsights.sql">https://github.com/ellak-monades-aristeias/DiavgeiaInsights/blob/master/PE1_DB/diavgeiainsights.sql</a>) για να εισάγετε το σχήμα της βάσης δεδομένων μαζί με κάποια βασικά δεδομένα.</p>

<p>Η εισαγωγή μπορεί να γίνει μέσω γραμμής εντολών, ή πρόγράμματος όπως το MySQL Workbench και το phpMyAdmin.</p>

<p>Τέλος στο αρχείο basic/config/db.php πρέπει να εισάγετε τα σωστά στοιχεία σύνδεσης.</p>

<p>&lt;?php</p>

<p>return [</p>

<p>'class' =&gt; 'yii\db\Connection',</p>

<p>'dsn' =&gt; 'mysql:host=localhost;dbname=diavgeiainsights',</p>

<p>'username' =&gt; 'USERNAME',</p>

<p>'password' =&gt; 'PASSWORD',</p>

<p>'charset' =&gt; 'utf8',</p>

<p>];</p>

<h1>
<a id="user-content-Πλοήγηση" class="anchor" href="#%CE%A0%CE%BB%CE%BF%CE%AE%CE%B3%CE%B7%CF%83%CE%B7" aria-hidden="true"><span class="octicon octicon-link"></span></a>Πλοήγηση</h1>

<p>Μετά την επιτυχημένη εγκατάσταση μπορείτε να πλοηγηθείτε στην εφαρμογή χρησιμοποιώντας τον φυλλομετρητή σας (browser).</p>

<p>Αν π.χ. το root directory δείχνει στο <a href="http://localhost/">http://localhost</a>, τότε η εφαρμογή μας θα βρίσκεται στο <a href="http://localhost/basic/web">http://localhost/basic/web</a> .</p>

<p><img class="img-responsive" src="../web/images/manual/00_homepage.jpg" alt=""></p>

<p>Η αρχική οθόνη της εφαμοργής μας.</p>

<p><img class="img-responsive" src="../web/images/manual/02_login.jpg?raw=true" alt=""></p>

<p>Από το μενού Login, μπορούμε να κάνουμε είσοδο στο σύστημα και να έχουμε περισσότερες επιλογές. Ο default χρήστης και κωδικός είναι ο admin/admin.</p>

<p><img class="img-responsive" src="../web/images/manual/03_organisations.jpg?raw=true" alt=""></p>

<p>Η σελίδα με τους διαθέσιμους Οργανισμούς</p>

<p><img class="img-responsive" src="../web/images/manual/08_about.jpg?raw=true" alt=""></p>

<p>Η σελίδα με τα Σχετικά του προγράμματος.</p>

<p>Πίνακας Ελέγχου – Διαχείριση</p>

<p><img class="img-responsive" src="../web/images/manual/04_admin_panel01.jpg?raw=true" alt=""></p>

<p>Στον πίνακα ελέγχου, μπορείτε να ορίσετε τους Οργανισμούς που θέλετε να κατεβάσετε στοιχεία, τον τύπο των αποφάσεων (υποστηρίζεται μόνο Β.2.1), καθώς και το εύρος ημερομηνιών (από-έως).</p>

<p><img class="img-responsive" src="../web/images/manual/05_admin_panel02.jpg?raw=true" alt=""></p>

<p>Πατώντας στο dropdown στοιχείο με τους οργανισμούς, εμφανίζεται η λίστα με τους επιλεγμένους και διαθέσιμους οργανισμούς (~4200), ενώ υποστηρίζεται και η λειτουργία αναζήτησης.</p>

<p><img class="img-responsive" src="../web/images/manual/06_admin_panel03.jpg?raw=true" alt=""></p>

<p>Πατώντας πάνω σε μια από τις ημερομηνίες, εμφανίζεται το κουτάκι με το ημερολόγιο για πιο εύκολη και κατανοητή είσοδο της ημερομηνίας.</p>

<p><img class="img-responsive" src="../web/images/manual/07_admin_panel04.jpg?raw=true" alt=""></p>

<p>Αφού έχετε ολοκληρώσει με τη διαδικασία αυτή, πατώντας το πλήκτρο 'Ανανέωση', αποθηκεύονται οι ρυθμίσεις σας στη ΒΔ.</p>

<p>Στο δεξί μέρος της οθόνης, στο πατώντας το πλήκτρο 'Ενημέρωση Από τη Διαύγεια', τρέχει στο παρασκήνιο η διαδικασία ενημέρωσης της ΒΔ από τη Διαύγεια. Η διαδικασία μπορεί να είναι χρονοβόρος, ενώ όσο τρέχει εμφανίζεται στην οθόνη μας το εικονίδιο του 'loading'</p>

<p><img class="img-responsive" src="../web/images/manual/07_admin_panel04.jpg?raw=true" alt=""></p>

<h3>
<a id="user-content-Αναζήτηση-Αποφάσεων-και-Αποτελεσμάτων" class="anchor" href="#%CE%91%CE%BD%CE%B1%CE%B6%CE%AE%CF%84%CE%B7%CF%83%CE%B7-%CE%91%CF%80%CE%BF%CF%86%CE%AC%CF%83%CE%B5%CF%89%CE%BD-%CE%BA%CE%B1%CE%B9-%CE%91%CF%80%CE%BF%CF%84%CE%B5%CE%BB%CE%B5%CF%83%CE%BC%CE%AC%CF%84%CF%89%CE%BD" aria-hidden="true"><span class="octicon octicon-link"></span></a>Αναζήτηση Αποφάσεων και Αποτελεσμάτων</h3>

<p>Στο μενού 'Αναζήτηση' εμφανίζεται η βασική οθόνη αναζήτησης αποφάσεων και στατιστικών. Τα ερωτήματα είναι “προκατασκευασμένα” και οι παράμετροι αναζήτησης δίνονται από τα πεδία.</p>

<p><img class="img-responsive" src="../web/images/manual/09_resultmain.jpg?raw=true" alt=""></p>

<p>Α. Αποφάσεις ανά μήνα για Οργανισμό.</p>

<p><img class="img-responsive" src="../web/images/manual/10_org_month_01.jpg?raw=true" alt=""></p>

<p>Το πρώτο ερώτημα, θέλει σαν παράμετρο έναν από τους οργανισμούς τα στοιχεία των οποίων έχετε ήδη αποθηκεύσει στη Βάση Δεδομένων.</p>

<p>Πατώντας στο πλήκτρο 'Εμφάνιση' περνάμε στη σελίδα αποτελεσμάτων.</p>

<p><img class="img-responsive" src="../web/images/manual/10_org_month_02.jpg?raw=true" alt=""></p>

<p>Η οθόνη αποτελεσμάτων αποτελείται από ένα διάγραμμα όπου εμφανίζονται τα ποσά των αποφάσεων τύπου Β.2.1 (Έγκριση Πληρωμής) ανά μήνα.</p>

<p><img class="img-responsive" src="../web/images/manual/10_org_month_03.jpg?raw=true" alt=""></p>

<p>Επίσης έχουμε και τον πίνακα αποτελεσμάτων όπου έχουμε περισσότερα στοιχεία συνολικό ΠΟΣΟ, ΠΛΗΘΟΣ αποφάσεων και Μέσος Όρος (ΜΟ).</p>

<p><img class="img-responsive" src="../web/images/manual/10_org_month_04.jpg?raw=true" alt=""></p>

<p>Παράλληλα στον πίνακα έχουμε και την επιλογή εμφάνισης όλων των αποτελεσμάτων ή την σελιδοποίησή τους με το πλήκτρο 'Page/All'.</p>

<p><img class="img-responsive" src="../web/images/manual/10_org_month_04.jpg?raw=true" alt=""></p>

<p>Επιπλέον, υπάρχει και η επιλογή εξαγωγής των αποτελεσμάων σε HTML μορφή, σε CSV αρχείο, απλό κείμενο, φύλλο Excel, PDF και JSON, για περαιτέρω επεξεργασία.</p>

<p>Β. Αποφάσεις ανά CPV για Οργανισμό</p>

<p><img class="img-responsive" src="../web/images/manual/11_org_cpv_01.jpg?raw=true" alt=""></p>

<p>Το δεύτερο ερώτημα, θέλει σαν παράμετρο έναν από τους οργανισμούς τα στοιχεία των οποίων έχετε ήδη αποθηκεύσει στη Βάση Δεδομένων.</p>

<p>Πατώντας στο πλήκτρο 'Εμφάνιση' περνάμε στη σελίδα αποτελεσμάτων.</p>

<p><img class="img-responsive" src="../web/images/manual/11_org_cpv_02.jpg?raw=true" alt=""></p>

<p>Η οθόνη αποτελεσμάτων αποτελείται από ένα διάγραμμα όπου εμφανίζονται τα ποσά των αποφάσεων τύπου Β.2.1 (Έγκριση Πληρωμής) ανά CPV (Common Procurement Vocabulary).</p>

<p><img class="img-responsive" src="../web/images/manual/11_org_cpv_03.jpg?raw=true" alt=""></p>

<p>Τέλος έχουμε τον πίνακα αποτελεσμάτων όπου έχουμε περισσότερα στοιχεία όπως συνολικό ΠΟΣΟ, ΠΛΗΘΟΣ αποφάσεων και Μέσος Όρος (ΜΟ).</p>

<p>Γ. Αποφάσεις ανά Μήνα για CPV και Οργανισμό</p>

<p><img class="img-responsive" src="../web/images/manual/12_org_cpv_month_01.jpg?raw=true" alt=""></p>

<p>Σε αυτό το ερώτημα θα χρειαστούμε πέρα από τον οργανισμό και το CPV που θέλουμε να αναζητήσουμε.</p>

<p><img class="img-responsive" src="../web/images/manual/12_org_cpv_month_02.jpg?raw=true" alt=""></p>

<p>Η οθόνη αποτελεσμάτων αποτελείται από ένα διάγραμμα όπου εμφανίζονται τα ποσά των αποφάσεων τύπου Β.2.1 (Έγκριση Πληρωμής) ανά μήνα για το συγκεκριμένο CPV και οργανισμό.</p>

<p><img class="img-responsive" src="../web/images/manual/12_org_cpv_month_03.jpg?raw=true" alt=""></p>

<p>Καθώς και τον πίνακα αποτελεσμάτων όπου έχουμε περισσότερα στοιχεία όπως συνολικό ΠΟΣΟ, ΠΛΗΘΟΣ αποφάσεων και Μέσος Όρος (ΜΟ).</p>

    </div>

 
  </div>
  </div>
</div>
</div>
</div>
  </div>
            </div>
             <!--</div>-->
        <div class="col-lg-2">
            <a target="_blank" href="http://diavgeia.gov.gr"><img class="img-responsive" src="../web/images/diavgeia_all_logo.png"></a>
        </div>
    </div>
