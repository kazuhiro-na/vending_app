$(document).ready(function() {
  $('#search-form').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      url: $(this).attr('action'),
      method: $(this).attr('method'),
      data: formData,
      success: function(response) {
        var productList = $('.products_list tbody');
        var products = $(response).find('#products-table tbody tr');
        productList.empty();

        var productListArray = [];

        products.each(function() {
          var company = $(this).find('td:nth-child(1)').text();
          var image = $(this).find('td:nth-child(2) img').attr('src');
          var name = $(this).find('td:nth-child(3) a').text();
          var price = $(this).find('td:nth-child(4)').text();
          var stock = $(this).find('td:nth-child(5)').text();
          var comment = $(this).find('td:nth-child(6)').text();
          var id = parseInt($(this).data('id'));

          var product = {
            company: company,
            image: image,
            name: name,
            price: price,
            stock: stock,
            comment: comment,
            id: id,
            url: 'products/' + id
          };

          productListArray.push(product);
        });

        console.log(productListArray);
        console.log(products);

        productListArray.forEach(function(product) {
          var url = 'products/' + product.id;
          var html = '<tr>' +
            '<td>' + product.company + '</td>' +
            '<td><img src="' + product.image + '" alt="商品画像" style="max-width: 200px;"></td>' +
            '<td><a href="' + product.url + '">' + product.name + '</a></td>' +
            '<td>' + product.price + '</td>' +
            '<td>' + product.stock + '</td>' +
            '<td>' + product.comment + '</td>' +
            '<td>' +
            '<form action="' + url + '" onsubmit="return confirm(\'本当に削除しますか？\');">' +
            '<button type="submit" class="btn btn-danger delete-btn"  data-product-id="' + product.id + '">削除</button>' +
            '</form>' +
            '</td>' +
            '</tr>';

          productList.append(html);
        });
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  });
  $('.delete-btn').click(function(e) {
    e.preventDefault();

    var form = $(this).closest('form');
    var url = form.attr('action');

    if (confirm('本当に削除しますか？')) {
      $.ajax({
        url: url,
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
          form.closest('tr').remove();
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      })
    }
  });
  
});
  