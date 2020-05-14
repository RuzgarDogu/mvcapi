# Yöntem

#1 İlk Giriş (purchaseToken)
Önce login olabilmek için bir purchase key ile giriş denemesi yapılıyor.
Sadece statik bir IP ile giriş yapılabilir.

#2 Login
Eğer ip ve veritabanında böyle bir uygulamanın olduğu onaylanırsa, o zaman login'e izin veriliyor.
1 numaralı yöntem tüm istekler zaten Controller ana klasında tanımlanıyor.
Login'e izin verilirse eğer, login bilgileri kontrol ediliyor, ve böyle bir kullanıcı varsa o zaman bu kullanıcıya ait bilgiler, uygulama bilgileri ile birlikte webtoken olarak gönderiliyor. 

#3 Webtoken
Gelen webtoken içinde "beni hatırla" seçeneği olup olmadığı da yazılıyor.
	(beniHatirla = 1) gibi.
Gelen webtoken win.store ile local storage'a kaydediliyor.
location.replace ile panel'e giriş sağlanıyor.

# Çıkış
Eğer çıkış yapılırsa, win.store ile kaydedilen bilgi siliniyor.

# Sonraki Açılışlar
Login ekranı açılır açılmaz $(ready) win.store kontrol ediliyor.
Eğer bir token varsa bu token kontrol için sunucuya gönderiliyor.
Sunucudan gelen bilgi tamam ise, o zaman direkt olarak panel ekranına yönleniyor.