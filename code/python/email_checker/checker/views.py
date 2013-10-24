from restless.views import Endpoint
from restless.http import HttpError

from .forms import EmailForm


class EmailCheckerEndpoint(Endpoint):

    def post(self, request):
        form = EmailForm(request.data)
        if form.is_valid():
            return {'status': True, 'poruka': "Emajl provjeren!"}
        else:
            return {'status': False, 'poruka': 'Emajl ne valja!'}

#			Nije mi toliko bitan 400, koliko da je status: boolean 
#			raise HttpError(400, 'Mail Not Verified',
#			error=form.errors['email'][0])
