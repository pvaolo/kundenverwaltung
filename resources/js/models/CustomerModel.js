import axios from 'axios';

export default {
  fetchCustomers() {
    return axios.get('/api/customers')
      .then(response => {
        if (response.headers['content-type'].includes('application/json')) {
          return response.data;
        } else {
          console.warn('Unexpected response format:', response.data);
          return [];
        }
      })
      .catch(error => {
        console.error('Error fetching customers:', error.response ? error.response.data : error.message);
        return [];
      });
  },
  deleteCustomer(id) {
    return axios.delete(`/api/customers/${id}`)
      .then(() => {
        return true;
      })
      .catch(error => {
        console.error('Error deleting customer:', error);
        throw error;
      });
  },
  filterCustomers(customers, search) {
    return customers.filter(customer => {
      return (
        customer.id.toString().includes(search) ||
        `${customer.last_name}, ${customer.first_name}`.toLowerCase().includes(search.toLowerCase()) ||
        customer.email.toLowerCase().includes(search.toLowerCase())
      );
    });
  }
}
