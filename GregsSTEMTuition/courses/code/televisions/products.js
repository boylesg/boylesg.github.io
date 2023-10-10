function Product(strBrand, strName, fPrice, strImageFilename, strPaypal)
{
	this.strBrand = strBrand;
	this.strName = strName;
	this.fPrice = fPrice;
	this.strImageFilename = strImageFilename;
	this.strPaypal = strPaypal;
	
	return this;
}

let g_strPaypal = "<form action=\"\" method=\"post\" target=\"_self\"><input type=\"hidden\" name=\"cmd0\" value=\"_s-xclick\" /><input type=\"hidden\" name=\"hosted_button_id0\" value=\"AJ472KN2R9VG2\" /><input type=\"hidden\" name=\"currency_code0\" value=\"AUD\" /><input type=\"image\" src=\"https://www.paypalobjects.com/en_AU/i/btn/btn_paynowCC_LG.gif\" border=\"0\" name=\"submit0\" title=\"PayPal - The safer, easier way to pay online!\" alt=\"Buy Now\" /></form>";
let g_arrayTVs = [
					new Product("TLC", "TCL 55\" C845 4K UHD Mini LED QLED Google TV", 1695, "tv1.jpg", g_strPaypal),
					new Product("Sony", "Sony 85\" X90L Bravia XR Full Array LED 4K Google TV", 3995, "tv2.jpg",g_strPaypal),
					new Product("LG", "LG 75\" UR8050 4K UHD LED Smart TV", 1795, "tv3.jpg", g_strPaypal),
					new Product("Hisense", "Hisense 40\" A4KAU Full HD Smart TV", 395, "tv4.jpg", g_strPaypal),
					new Product("FFalcon", "FFalcon 40\” S53 FHD Smart TV", 329, "tv5.jpg", g_strPaypal),
					new Product("Samsung", "Samsung 75\" Q70C QLED 4K Smart TV", 2995, "tv6.jpg", g_strPaypal)
				 ];

function DoDisplayProducts(arrayProducts)
{    
    // Output the conten ts of the products array to the console tab.
    console.log(arrayProducts);

    // Start the table.
    document.write("<table cellspacing=\"0\" cellpadding=\"20\" border=\"1\">");

    // Set up the column headings.
    document.write("<tr><th>PRODUCT</th><th>PRICE</th><th>IMAGE</th></tr>");

    // Loop through our products array
    for (let nI = 0; nI < arrayProducts.length; nI++)

    {
        // For each product start a table row.
        document.write("<tr>");

        // Create a cell on the current product row for the product name.
        document.write("<td>" + arrayProducts[nI].strName + "</td>");

        // Create a cell on the current product row for the product price.

        document.write("<td style=\"text-align:center;\">$" + arrayProducts[nI].fPrice.toFixed(2) + "<br/><br/>" + arrayProducts[nI].strPaypal + "</td>");

        // Create a cell on the current product row for the product image.
        document.write("<td><img src=\"" + arrayProducts[nI].strImageFilename + "\" alt=\"" + arrayProducts[nI].strImageFilename + "\" width=\"200\"/</td>");

        // For each product finish the table row.
        document.write("</tr>");
    }
    // Finish the table.
    document.write("</table>");
}
