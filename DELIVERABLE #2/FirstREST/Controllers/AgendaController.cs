using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;

namespace FirstREST.Controllers
{
    public class AgendaController : ApiController
    {
        // GET: /Agenda/
        public IEnumerable<Activity> Get()
        {
            return Lib_Primavera.PriIntegration.ListActivities();
        }

        // GET: /Agenda/activityId
        public Activity Get(string id)
        {
            Lib_Primavera.Model.Activity activity = Lib_Primavera.PriIntegration.GetActivity(id);
            if (activity == null)
            {
                throw new HttpResponseException(Request.CreateResponse(HttpStatusCode.NotFound));
            }
            else
            {
                return activity;
            }
        }
    }
}
