using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;

namespace FirstREST.Controllers
{
    public class DashboardController : ApiController
    {
        // GET: /dashboard/?representative_id=<representative_id>
        public Dashboard Get(string representative_id)
        {
            return Lib_Primavera.PriIntegration.GetDashboard(representative_id);
        }
    }
}
