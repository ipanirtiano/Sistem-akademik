const flashData = $(".flash-data").data("flashdata");

if (flashData) {
  Swal.fire({
    icon: "success",
    title: "Berhasil",
    text: "Yes! " + flashData,
  });
}
