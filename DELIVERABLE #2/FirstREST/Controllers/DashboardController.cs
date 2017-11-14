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
        public dynamic Get(string representative_id)
        {
            List<Activity> today_agenda = Lib_Primavera.PriIntegration.GetDashboardTodayAgenda(representative_id);
            List<Objectives> objectives = Lib_Primavera.PriIntegration.GetDashboardObjectives(representative_id);
            List<Statistics> statistics = Lib_Primavera.PriIntegration.GetDashboardStatistics(representative_id);
            dynamic dashboard = new dynamic[] { today_agenda, objectives, statistics };
            return dashboard;
        }
    }
}
