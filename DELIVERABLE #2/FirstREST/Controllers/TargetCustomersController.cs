using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;

namespace FirstREST.Controllers
{
    public class Target_CustomersController : ApiController
    {
        // GET: /target_customers/
        public IEnumerable<TargetCustomer> Get()
        {
            return Lib_Primavera.PriIntegration.ListTargetCustomers();
        }

        // GET: /target_customers/<customer_id>
        public IEnumerable<TargetCustomer> Get(string id)
        {
            return Lib_Primavera.PriIntegration.ListTargetCustomers(id);
        }
    }
}
