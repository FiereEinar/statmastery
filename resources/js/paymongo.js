import axios from 'axios';
import dotenv from 'dotenv';
dotenv.config();

const options = {
  url: 'https://api.paymongo.com/v1/checkout_sessions',
  headers: {
    accept: 'application/json',
    'Content-Type': 'application/json',
    authorization: `Basic ${process.env.PAYMONGO_SECRET}`
  },
  // data: {
  //   data: {
  //     attributes: {
  //       send_email_receipt: false,
  //       show_description: true,
  //       show_line_items: true,
  //       description: 'Cancelled checkout',
  //       line_items: [{currency: 'PHP', amount: 40000, name: 'checkout', quantity: 1}],
  //       payment_method_types: ['gcash', 'paymaya']
  //     }
  //   }
  // }
};

const paymongo = axios.create({
  baseURL: 'https://api.paymongo.com/v1/checkout_sessions',
  headers: {
    accept: 'application/json',
    'Content-Type': 'application/json',
    Authorization: `Basic ${process.env.PAYMONGO_SECRET}`
  }
});
