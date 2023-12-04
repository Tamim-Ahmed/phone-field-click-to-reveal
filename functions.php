function hidden_phone_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => '1234567890', // Default phone number
        'text' => 'Call us', // Default text
    ), $atts, 'hidden_phone');

    $phone_number = $atts['number'];
    $text = $atts['text'];

    $displayed_number = substr($phone_number, 0, -4) . 'xxxx';

    ob_start();
    ?>
    <a href="tel:<?php echo esc_attr($phone_number); ?>" class="phone"><?php echo esc_html($displayed_number); ?></a>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneLinks = document.querySelectorAll('.phone');

            phoneLinks.forEach(phoneLink => {
                let fullPhoneNumber = phoneLink.getAttribute('href').replace('tel:', '');
                let displayedPhoneNumber = fullPhoneNumber.slice(0, -4) + 'xxxx';
                let isHidden = true;

                phoneLink.textContent = displayedPhoneNumber;

                phoneLink.addEventListener('click', function(event) {
                    event.preventDefault();

                    if (isHidden) {
                        phoneLink.textContent = fullPhoneNumber;
                    } else {
                        window.location.href = 'tel:' + fullPhoneNumber;
                    }

                    isHidden = !isHidden;
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('hidden_phone', 'hidden_phone_shortcode');



//Add this code to your themes functions.php file
//SHORTCODE TO EXECUTE THE CODE - [hidden_phone number="1234567890" text="Call us"] (use the shortcode wherever you want to show the number, just replace the "number" in the shortcode with your number)
