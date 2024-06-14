<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ece</title>
</head>
<body>
    <form>
        <table>
            <tr>
                <td>Ad:</td>
                <td><input type="text" name="name" id="name"><br></td>
            </tr>
            <tr></tr>
                <td>Soyad:</td>
                <td><input type="text" name="surname" id="surname"><br></td>
            </tr>
            <tr>
                <td>E-Posta:</td>
                <td><input type="email" name="email" id="email"><br></td>
            </tr>
            <tr>
                <td>Şifre:</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td>Şifre Tekrarı:</td>
                <td> <input type="password" id="password" name="password"></td>
            </tr>
            <tr>
                <td>Doğum Tarihi:</td>
                <td><input type="date" name="birthDate" id="birthDate"><br></td>
            </tr>
            <tr>
                <td>Cinsiyet:</td>
            </tr>
            <tr>
                <td>Erkek: <input type="radio" name="erkek" id="gender"></td>
                <td>Kadın: <input type="radio" name="kadın" id="gender"> </td>
            </tr>
            <tr>
                <td><input type="submit" value="Gönder"></td>
                <td></td>
            </tr>
        </table>
    </form>


    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var surname = document.getElementById("surname").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var birthDate = document.getElementById("birthDate").value;
            var gender = document.getElementById("gender").value;

            // Boş alan kontrolü
            if (name == "" || surname == "" || email == "" || password == "" || birthDate == "" || gender == "") {
                alert("Lütfen tüm alanları doldurun.");
                return false;
            }

            // E-posta formatı kontrolü
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Geçerli bir e-posta adresi girin.");
                return false;
            }

            // Şifre uzunluğu kontrolü
            if (password.length < 6 || confirmPassword.length < 6) {
            alert("Şifre en az 6 karakter olmalıdır.");
            return false;
            }

            // Şifrelerin eşleştiğini kontrol et
            if (password != confirmPassword) {
                alert("Şifreler eşleşmiyor.");
                return false;
            }

            return true; // Form geçerli ise true döndür
        }
    </script>


    <?php
        // Formdan gelen verileri al
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];

        // Benzersiz e-posta adresi oluştur
        $uniqueEmail = generateUniqueEmail($email);

        // Veritabanına bağlan
        $servername = "localhost";
        $username = "kullaniciadi";
        $password = "sifre";
        $dbname = "veritabaniadi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        // Veritabanına ekle
        $sql = "INSERT INTO kullanıcılar (isim, soyisim, email, sifre, dogum_tarihi, cinsiyet) VALUES ('$name', '$surname', '$uniqueEmail', '$password', '$birthDate', '$gender')";

        if ($conn->query($sql) === TRUE) {
            echo "Yeni kayıt başarıyla oluşturuldu";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        // Benzersiz e-posta oluşturma fonksiyonu
        function generateUniqueEmail($email) {
            // E-posta adresini benzersiz hale getir
            // Bu örnekte, e-posta adresine rastgele bir sayı ekleyeceğiz
            // Siz istediğiniz şekilde benzersizleştirme yapabilirsiniz
            $uniqueSuffix = rand(1000, 9999); // Rastgele 4 haneli sayı
            $uniqueEmail = $email . "_" . $uniqueSuffix; // Örneğin: example@gmail.com_1234

            return $uniqueEmail;
        }
    ?>






</body>
</html>