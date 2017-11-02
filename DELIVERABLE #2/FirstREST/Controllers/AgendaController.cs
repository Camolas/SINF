using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace FirstREST.Controllers
{
    public class AgendaController : ApiController
    {
        // GET: /Agenda/
        public IEnumerable<Lib_Primavera.Model.Activity> Get()
        {
            return Lib_Primavera.PriIntegration.ListActivities();
        }
    }
}
