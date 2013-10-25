from restless.views import Endpoint
from restless.http import HttpError

from .forms import EmailForm


class EmailCheckerEndpoint(Endpoint):

    def post(self, request):
        form = EmailForm(request.data)
        if form.is_valid():
            return {'status': True, 'poruka': "Emajl provjeren!"}
        else:
#           Nije mi toliko bitan 400, koliko da je status: boolean 
            return {'status': False, 'poruka': 'Emajl ne valja!'}

#           raise HttpError(400, 'Mail Not Verified',
#           error=form.errors['email'][0])
