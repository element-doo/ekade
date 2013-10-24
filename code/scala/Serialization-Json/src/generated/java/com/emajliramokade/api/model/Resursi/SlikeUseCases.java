package com.emajliramokade.api.model.Resursi;

public interface SlikeUseCases<T> {
    com.emajliramokade.api.model.Resursi.PodaciSlike getOriginal();

    T setOriginal(final com.emajliramokade.api.model.Resursi.PodaciSlike value);

    com.emajliramokade.api.model.Resursi.PodaciSlike getWeb();

    T setWeb(final com.emajliramokade.api.model.Resursi.PodaciSlike value);

    com.emajliramokade.api.model.Resursi.PodaciSlike getEmail();

    T setEmail(final com.emajliramokade.api.model.Resursi.PodaciSlike value);

    com.emajliramokade.api.model.Resursi.PodaciSlike getThumbnail();

    T setThumbnail(final com.emajliramokade.api.model.Resursi.PodaciSlike value);
}
